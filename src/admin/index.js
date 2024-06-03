import React from "react";
import { createRoot } from "react-dom/client";
import App from "./App";
import "@/admin/utilities/tailwindcss.min.js";
import { HashRouter } from "react-router-dom";
const root = createRoot(
  document.getElementById("react-plugin-structure-admin-app")
);
root.render(
  <HashRouter>
    <App />
  </HashRouter>
);
