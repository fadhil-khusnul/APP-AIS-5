import React, { useState } from 'react';
import { BrowserRouter, Router, useNavigate } from 'react-router-dom';
import ReactDOM from 'react-dom/client';

export default function Sidebar() {
  const [activeLink, setActiveLink] = useState('');
  const navigate = useNavigate();

  const handleMenuClick = (path) => {
    setActiveLink(path);
    navigate(path);

    console.log(path);
  };

  return (
    <div className="menu">
      <div className="menu-item">
        <button className={`menu-item-link menu-item-toggle ${activeLink === '/user' ? 'active' : ''}`} onClick={() => handleMenuClick('/user')}>
          <div className="menu-item-icon">
            <i className="fa fa-user"></i>
          </div>
          <span className="menu-item-text">USER</span>
        </button>
      </div>
      <div className="menu-item">
        <button className={`menu-item-link menu-item-toggle ${activeLink === '/data' ? 'active' : ''}`} onClick={() => handleMenuClick('/data')}>
          <div className="menu-item-icon">
            <i className="fa fa-folder-open"></i>
          </div>
          <span className="menu-item-text">DATA</span>
        </button>
      </div>
      <div className="menu-item">
        <button className={`menu-item-link menu-item-toggle ${activeLink === '/processload' ? 'active' : ''}`} onClick={() => handleMenuClick('/processload')}>
          <div className="menu-item-icon">
            <i className="fa fa-folder-open"></i>
          </div>
          <span className="menu-item-text">ProcessLoad</span>
        </button>
      </div>
      {/* Add more menu items here */}
    </div>

  );
}

// if (document.getElementById('sidebar')) {
//   const root = ReactDOM.createRoot(document.getElementById("sidebar"));
//   root.render(
//     <React.StrictMode>
//         <Router>

//           <Sidebar path={"/data"} />
//         </Router>
//     </React.StrictMode>
//   );
// }