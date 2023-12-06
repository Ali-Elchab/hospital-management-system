import React, { useEffect, useState } from "react";
import "./style.css";
import { useParams } from "react-router-dom";
import { sendRequest } from "../../core/helpers/request";
const EditDoctor = () => {
  let { id } = useParams();
  const [doctor, setDoctor] = useState([]);
  useEffect(() => {
    const getDoctor = async () => {
      const response = await sendRequest({
        body: {
          userID: parseInt(id),
        },
        route: "/getUser",
        method: "POST",
      });
      setDoctor(response);
      console.log(response);
    };
    getDoctor();
  }, []);
  return (
    <div className="container">
      <h1>{doctor.name}</h1>
      <div className="form">
        <div className=" field flex column ">
          <label htmlFor="username">Username</label>
          <input type="text" name="username" value={doctor.username} />
        </div>
        <div className="field flex column">
          <label htmlFor="password">password</label>
          <input type="text" name="password" value={doctor.password} />
        </div>
        <div className="field flex column">
          <label htmlFor="name">name</label>
          <input type="text" name="name" value={doctor.name} />
        </div>
        <div className="field flex column">
          <label htmlFor="specialization">specialization</label>
          <input type="text" name="specialization" value={doctor.specialization} />
        </div>
        <div className="field flex column">
          <label htmlFor="contact">contact</label>
          <input type="text" name="contact" value={doctor.contact} />
        </div>
      </div>
    </div>
  );
};

export default EditDoctor;
