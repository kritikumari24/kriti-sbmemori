<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\CustomerExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerRequest;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use App\Services\ManagerLanguageService;
use App\Services\CustomerService;
use App\Services\UtilityService;

class CustomerController extends Controller
{
    protected $mls, $change_password, $assign_role, $profile_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $profile_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $customerService, $utilityService;

    public function __construct()
    {
        //Permissions
        // $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:customer-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:customer-edit', ['only' => ['edit', 'update', 'status']]);
        // $this->middleware('permission:customer-delete', ['only' => ['destroy']]);

        //Data
        $this->assign_role = 'Customer';
        $this->profile_image_directory = 'files/users';
        //route
        $this->index_route_name = 'admin.customers.index';
        $this->create_route_name = 'admin.customers.create';
        $this->detail_route_name = 'admin.customers.show';
        $this->edit_route_name = 'admin.customers.edit';

        //view files
        $this->index_view = 'admin.customer.index';
        $this->create_view = 'admin.customer.create';
        $this->detail_view = 'admin.customer.details';
        $this->profile_view = 'admin.customer.profile';
        $this->edit_view = 'admin.customer.edit';
        $this->product_history_view = 'admin.customer.product_history';
        $this->change_password = 'admin.admin_profile.change_password';

        //service files
        $this->customerService = new CustomerService();
        $this->utilityService = new UtilityService();

        //mls is used for manage language content based on keys in messages.php
        $this->mls = new ManagerLanguageService('messages');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = CustomerService::datatable();
            if (isset($request->name)) {
                $items = $items->where('name', 'like', "%{$request->name}%");
            }
            if (isset($request->email)) {
                $items = $items->where('email', 'like', "%{$request->email}%");
            }
            if (isset($request->mobile_no)) {
                $items = $items->where('mobile_no', $request->mobile_no);
            }
            if (isset($request->customer_id)) {
                $items = $items->where('id', $request->customer_id);
            }
            if (isset($request->status)) {
                $items = $items->where('is_active', $request->status);
            }
            return datatables()->eloquent($items)->toJson();
        } else {
            return view($this->index_view);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->create_view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $image = FileService::imageUploader($request, 'image', $this->profile_image_directory);
        if ($image != null) {
            $input['image'] = $image;
        }
        $customer = $this->customerService::create($input);
        // $customer = User::create($input);
        $customer->assignRole($this->assign_role);

        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('created', 'customer', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $customer)
    {
        $lang_array = [
            'en' => 'English',
            'gr' => 'German',
        ];
        return view($this->profile_view, compact('customer', 'lang_array'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $customer)
    {
        return view($this->edit_view, compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, User $customer)
    {
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        if (!empty($input['image'])) {
            $image = FileService::imageUploader($request, 'image', $this->profile_image_directory);
            if ($image != null) {
                $input['image'] = $image;
            }
        } else {
            $input = Arr::except($input, array('image'));
        }

        $this->customerService->update($input, $customer);

        // return redirect()->route($this->index_route_name)
        return redirect()->back()
            ->with('success', $this->mls->messageLanguage('updated', 'customer', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $customer)
    {
        $result = $this->customerService->delete($customer);
        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('customer'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('customer'),
                'status_name' => 'error'
            ]);
        }
    }

    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = $this->customerService->status(['is_active' => $status], $id);
        if ($result) {
            return response()->json([
                'status' => 1,
                'message' => $this->mls->messageLanguage('updated', 'status', 1),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => $this->mls->messageLanguage('not_updated', 'status', 1),
                'status_name' => 'error'
            ]);
        }
    }

    /**
     * Update the language in User.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLanguage(User $user, $language)
    {
        $result = $user->update(['lang' => $language]);
        session()->put('locale', $language);
        if ($result) {
            return response()->json([
                'status' => 1,
                'message' => $this->mls->onlyNameLanguage('language_updated'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => $this->mls->onlyNameLanguage('language_not_updated'),
                'status_name' => 'error'
            ]);
        }
    }

    public function export(Request $request)
    {
        return (new CustomerExport($request))->download('customers.xlsx');
    }

    public function productHistory(User $customer)
    {
        return view($this->product_history_view, compact('customer'));
    }
}
