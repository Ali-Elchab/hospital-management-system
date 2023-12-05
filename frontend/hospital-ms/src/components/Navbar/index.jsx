import React from "react";
import "./style.css";
import favIcon from "../../assets/logo.png";

const Navbar = () => {
  return (
    <div class="navbar flex ">
      <img src={favIcon} alt="" />
      <div class="dropdown">
        <button class="dropbtn">
          Admin
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <button>Profile</button>
        </div>
      </div>
    </div>
  );
};

export default Navbar;
