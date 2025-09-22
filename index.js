const fastify = require("fastify")({ logger: true });
const PORT = 5001;
const axios = require("axios");
// const fastifyCors = require("fastify-cors");
const dotenv = require("dotenv");
dotenv.config();

const baseUrl = process.env.APP_URL + "/api/v1";

fastify.register(require("fastify-socket.io"), {
    // put your options here
});

// fastify.register(fastifyCors),
//     {
//         origin: "*",
//         methods: "GET,POST,PUT,PATCH,DELETE",
//     };



fastify.get("/test", async (request, reply) => {
    console.log({ baseUrl });
    reply.send({ baseUrl });
});


fastify.get("/", (req, reply) => {
    fastify.io.emit("hello");
    reply.send("done");
});

fastify.ready().then(() => {
    // we need to wait for the server to be ready, else `server.io` is undefined
    fastify.io.on("connection", (socket) => {
        console.log([socket.id, "Connect The Server"]);
        console.log({
            socket_handshake: socket.handshake.headers.authorization,
        });

        const config = {
            headers: {
                Authorization: socket.handshake.headers.authorization,
            },
        };

        let data = { is_online: 1 };
        // onlineOfflineStatus(data, config, socket); //User Online offline status Update

        //For Customer App
        socket.on("customer-send-message", (data) => {
            axios
                .post(`${baseUrl}/role-chat/user`, data, config)
                .then((res) => {
                    console.log({ res_data: res.data });
                    console.log({ res: res });
                    socket.broadcast.emit("customer-message-receive", res.data);
                })
                .catch((err) => {
                    console.log({
                        Error_data: err,
                        response_data: err.response.data,
                    });
                    // return err;
                });
        });

        //For Therapist App
        socket.on("vendor-send-message", (data) => {
            axios
                .post(`${baseUrl}/role-chat/send-message`, data, config)
                .then((res) => {
                    console.log({ res_data: res.data });
                    socket.broadcast.emit(
                        "vendor-message-receive",
                        res.data
                    );
                })
                .catch((err) => {
                    console.log({ Error_data: err });
                });
        });

        socket.on("disconnect", (reason) => {
            let data = { is_online: 0 };
            onlineOfflineStatus(data, config, socket);
            socket.disconnect();
        });
    });
});



fastify.listen(5001, "0.0.0.0", (err) => {
    if (err) {
        fastify.log.error(err);
        process.exit(1);
    }
});
