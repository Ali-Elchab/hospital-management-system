import React, { useState } from "react";
import favIcon from "../../assets/logo-dark.png";
import "./style.css";
import { sendRequest } from "../../core/helpers/request";
import { useNavigate } from "react-router-dom";

const LoginPage = () => {
  const navigate = useNavigate();
  const [form, setForm] = useState({
    username: "",
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
    console.log(response.status);

    if (response.status === "success" && response.token) {
      // console.log("HelloWOrld");
      localStorage.setItem("logged_in", true);
      localStorage.setItem("token", response.token);
      localStorage.setItem("role", response.role);
      if (response.role === "admin") {
        navigate("/Admin");
      }
      if (response.role === "doctor") {
        navigate("/Doctor");
      }
      if (response.role === "patient") {
        navigate("/Patient");
      }
    }
  };

  return (
    <div className="flex column center page loginpage">
      <div className="flex column center page">
        <div className="account-logo">
          <img src={favIcon} alt="" />
        </div>
        <div className="input-group">
          <label>Username</label>
          <input
            type="text"
            name="username"
            placeholder="Username"
            required
            onChange={(e) => handleForm("username", e.target.value)}
          />
        </div>
        <div className="input-group">
          <label>Password</label>
          <input
            type="text"
            name="password"
            placeholder="Password"
            required
            onChange={(e) => handleForm("password", e.target.value)}
          />
        </div>
        <br />
        <button name="login" className="button-22" onClick={() => handleSubmit()}>
          Login
        </button>
      </div>
    </div>
  );
};

export default LoginPage;
