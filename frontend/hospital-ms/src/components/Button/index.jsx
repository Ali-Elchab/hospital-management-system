import React from "react";
import "./style.css";

const Button = ({ text, onClick }) => {
  return (
    <button className="primary-color white-text button" onClick={onClick}>
      {text}
    </button>
  );
};

export default Button;
