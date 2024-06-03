import React from "react";
import { useRoutes } from "react-router-dom";
import Home from "../views/Home";
import Options from "../views/Options";

const Router = () => {
  const routes = useRoutes([
    { path: "/", element: <Home /> },
    { path: "/options", element: <Options /> },
  ]);

  return routes;
};

export default Router;
