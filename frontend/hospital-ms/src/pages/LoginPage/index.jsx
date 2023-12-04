import React, { useState } from "react";
import favIcon from "../../assets/logo-dark.png";
import "./style.css";
import { sendRequest } from "../../core/helpers/request";
import { useNavigate } from "react-router-dom";

const LoginPage = () => {
  const navigate = useNavigate();
  const [form, setForm] = useState({
    email: "",
    password: "",
  });
  const handleForm = (field, value) => {
    setForm((prev) => {
      return {
        ...prev,
        [field]: value,
      };
    });
  };

  const handleSubmit = async () => {
    const response = await sendRequest({
      body: form,
      route: "/login",
      method: "POST",
    });

    if (response.status === "logged in") {
      // save the login status in redux
      localStorage.setItem("logged_in", true);
      navigate("/landing");
    }
  };

  return (
    <div>
      <div className="flex column center page">
        <div class="account-logo">
          <img src={favIcon} alt="" />
        </div>
        <div class="input-group">
          <label>Username</label>
          <input type="text" name="username" placeholder="Username" required />
        </div>
        <div class="input-group">
          <label>Password</label>
          <input type="password" name="pwd" placeholder="Password" required />
        </div>
        <br />
        <button name="login" class="button-22">
          Login
        </button>
      </div>
    </div>
  );
};

export default LoginPage;
