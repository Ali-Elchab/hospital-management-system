import React from "react";
import "./style.css";

const Navbar = () => {
  return (
    <div>
      <ul>
        <li>
          <button className="active">Home</button>
        </li>
        <li>
          <button href="#news">News</button>
        </li>
        <li>
          <button href="#contact">Contact</button>
        </li>
        <li>
          <button href="#contact">Contact</button>
        </li>
        <li>
          <button href="#contact">Contact</button>
        </li>
      </ul>
    </div>
  );
};

export default Navbar;
