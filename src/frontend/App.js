import React from "react";
import { Routes, Route, NavLink } from "react-router-dom";
import Router from "./router";

export default function App() {
  return (
    <>
      <nav className="space-x-4">
        <NavLink
          to="/"
          className={({ isActive }) =>
            isActive ? "border-b-2 border-blue-400" : ""
          }
        >
          Accueil
        </NavLink>
        <NavLink
          to="/options"
          className={({ isActive }) =>
            isActive ? "border-b-2 border-blue-200" : ""
          }
        >
          À propos
        </NavLink>
      </nav>
      <Router />
    </>
  );
}
