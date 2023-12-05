import React from "react";
import "./style.css";

const Sidebar = () => {
  return (
    <div className="sidenav primary-color ">
      <button className="active primary-color ">Admins</button>
      <button className="active primary-color ">Doctors</button>
      <button className="active primary-color ">Patients</button>
      <button className="active primary-color ">
        Assign Patient <br />
        To Room
      </button>
    </div>
  );
};

export default Sidebar;
