import React from "react";
import { createRoot } from "react-dom/client";
import App from "@/frontend/App";
import "@/admin/utilities/tailwindcss.min.js";
import { HashRouter } from "react-router-dom";
//ReactDOM.render(<AppRouter />, document.getElementById('react-plugin-structure-frontend-app'));
const root = createRoot(
  document.getElementById("react-plugin-structure-frontend-app")
);
root.render(
  <HashRouter>
    <App />
  </HashRouter>
);
