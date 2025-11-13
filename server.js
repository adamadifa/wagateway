import * as wa from "./server/whatsapp.js";
import fs from "fs";
import * as dbs from "./server/database/index.js";
import dotenv from "dotenv";
dotenv.config();
import * as lib from "./server/lib/index.js";
global.log = lib.log;


/**
 * EXPRESS FOR ROUTING
 */
import express from "express";
const app = express();
import http from "http";
const server = http.createServer(app);

/**
 * SOCKET.IO
 */
import { Server } from "socket.io";
const io = new Server(server, {
  pingInterval: 60000, // Increased from 25000 to 60000 (60 seconds)
  pingTimeout: 30000, // Increased from 10000 to 30000 (30 seconds)
  connectTimeout: 45000, // Added connection timeout
  upgradeTimeout: 30000, // Added upgrade timeout
  maxHttpBufferSize: 1e8, // 100MB buffer size
  allowEIO3: true, // Allow Engine.IO v3 clients
  cors: {
    origin: process.env.APP_URL || "*",
    methods: ["GET", "POST"],
    credentials: true,
    allowedHeaders: ["*"],
  },
  transports: ['websocket', 'polling'],
  // Add path if using reverse proxy
  path: process.env.SOCKET_PATH || "/socket.io/",
  // Allow more concurrent connections
  allowRequest: (req, callback) => {
    // Add any custom validation here if needed
    callback(null, true);
  },
});

const port = process.env.PORT_NODE;

app.get("/", (req, res) => {
  return res.redirect("/home");
});

// Health check endpoint for monitoring
app.get("/health", (req, res) => {
  res.status(200).json({
    status: "ok",
    timestamp: new Date().toISOString(),
    uptime: process.uptime(),
    socketConnections: io.engine.clientsCount || 0,
  });
});
app.use((req, res, next) => {
  res.set("Cache-Control", "no-store");
  req.io = io;
  next();
});

import bodyParser from "body-parser";


app.use(
  bodyParser.urlencoded({
    extended: false,
    limit: "50mb",
    parameterLimit: 100000,
  })
);

app.use(bodyParser.json());
app.use(express.static("src/public"));
import router from "./server/router/index.js"

app.use(router);

io.on("connection", (socket) => {
  console.log("A user connected:", socket.id);

  // Handle connection errors
  socket.on("error", (error) => {
    console.error("Socket error:", error);
  });

  socket.on("StartConnection", async (data) => {
    try {
      await wa.connectToWhatsApp(data, io);
    } catch (error) {
      console.error("Error in StartConnection:", error);
      socket.emit("error", {
        message: "Failed to start connection. Please try again.",
        error: error.message,
      });
    }
  });

  socket.on("ConnectViaCode", async (data) => {
    try {
      await wa.connectToWhatsApp(data, io, true);
    } catch (error) {
      console.error("Error in ConnectViaCode:", error);
      socket.emit("error", {
        message: "Failed to connect via code. Please try again.",
        error: error.message,
      });
    }
  });

  socket.on("LogoutDevice", async (device) => {
    try {
      await wa.deleteCredentials(device, io);
    } catch (error) {
      console.error("Error in LogoutDevice:", error);
      socket.emit("error", {
        message: "Failed to logout device. Please try again.",
        error: error.message,
      });
    }
  });

  socket.on("disconnect", (reason) => {
    console.log("A user disconnected:", socket.id, "Reason:", reason);
  });

  // Handle reconnection attempts
  socket.on("reconnect_attempt", () => {
    console.log("Reconnection attempt:", socket.id);
  });
});

server.listen(port, () => {
  console.log(`Server running and listening on port: ${port}`);
});
