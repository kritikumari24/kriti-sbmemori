<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmailTemplateRequest;
use App\Mail\MailTemplate;
use App\Models\EmailTemplate;
use App\Services\EmailTemplateService;
use App\Services\ManagerLanguageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailTemplateController extends Controller
{
    protected $mls;
    public function __construct()
    {
        $this->middleware('permission:email', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
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
            $items = EmailTemplateService::dataTable()
                ->orderBy('created_at', 'desc');
            return datatables()->eloquent($items)->toJson();
        } else {
            return view('admin.email.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.email.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailTemplateRequest $request)
    {
        $create = EmailTemplateService::create($request->all());
        return redirect()->route('emails.index')
            ->with('success', $this->mls->messageLanguage('created', 'email', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EmailTemplate $email)
    {
        $data = $email;
        return view('admin.email.details', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailTemplate $email)
    {
        $data = $email;
        return view('admin.email.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailTemplateRequest $request, EmailTemplate $email)
    {
        $update = EmailTemplateService::update($request->all(), $email);
        return redirect()->route('emails.index')
            ->with('success', $this->mls->messageLanguage('updated', 'email', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailTemplate $email)
    {
        $result = EmailTemplateService::delete($email);
        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->messageLanguage('deleted', 'email', 1),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->messageLanguage('not_deleted', 'email', 1),
                'status_name' => 'error'
            ]);
        }
    }

    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = EmailTemplateService::status(['is_active' => $status], $id);
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

    public function testMail(EmailTemplate $email, $custom_email = null)
    {
        $email_template = $email;
        $data_array = ['{{user_name}}' => 'TestingName-Tester'];

        if ($custom_email !==  null) {
            $mail_id = $custom_email;
        } else {
            $mail_id = 'yunoos.parvezansari@deorwine.com';
        }

        // dd($mail_id, $data_array, $email_template->slug, $email_template);
        try {
            Mail::to($mail_id)->send(new MailTemplate($data_array, $email_template->slug));

            $status = true;
        } catch (Exception $e) {
            dd('your mail id is = ' . $mail_id, $e);

            Log::channel('queue')->error("MailTemplateQueue -> handle -> " . $e);
        }
        return response()->json(['status' => 1, 'message' => 'email_id: ' . $mail_id]);
    }
}
