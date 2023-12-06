import React, { useEffect, useState } from "react";
import { useLocation } from "react-router-dom";
import "./style.css";
import favIcon from "../../assets/logo.png";

const Navbar = () => {
  const [isLogIn, setisLogIn] = useState(true);
  const location = useLocation();
  const [title, setTitle] = useState("");
  useEffect(() => {
    if (location.pathname === "/") {
      setisLogIn(true);
    } else {
      setisLogIn(false);
    }
    if (location.pathname === "/Admin") {
      setTitle("Admin");
    } else if (location.pathname === "/Doctor") {
      setTitle("Doctor");
    } else if (location.pathname === "/Patient") {
      setTitle("Patient");
    }
  }, [location.pathname]);
  return isLogIn ? (
    <></>
  ) : (
    <div className="navbar flex ">
      <img src={favIcon} alt="" />

      <div className="dropdown">
        <button className="dropbtn">
          {title}
          <i className="fa fa-caret-down"></i>
        </button>
        <div className="dropdown-content">
          <button>Profile</button>
          <button>Log Out</button>
        </div>
      </div>
    </div>
  );
};

export default Navbar;
