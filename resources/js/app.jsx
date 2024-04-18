import React from 'react';
import './bootstrap';
import ProcessLoad from './components/ProcessLoad';
import Sidebar from './components/Sidebar'
import ReactDOM from 'react-dom/client';
import { BrowserRouter, Route, Router, RouterProvider, Routes, createBrowserRouter, createRoutesFromElements } from 'react-router-dom';
import Data from './components/Data';
import User from './components/User';

const router = createBrowserRouter(
  createRoutesFromElements(

    <Route
      path="/*"
      element={
        <Routes>

          <Route element={<Sidebar />}>
            <Route path="/processload" element={<ProcessLoad />} />
            <Route path="/data" element={<Data />} />
            <Route path="/user" element={<User />} />

          </Route>


        </Routes>
      }
    />
  )
);
if (document.getElementById('sidebar')) {

  ReactDOM.createRoot(document.getElementById("sidebar")).render(
    <React.StrictMode>
      <RouterProvider router={router} />
    </React.StrictMode>
  );
}
