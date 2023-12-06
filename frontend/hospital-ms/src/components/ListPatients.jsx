import React, { useEffect, useState } from "react";
import { sendRequest } from "../core/helpers/request";
import Button from "./Button";
import { useNavigate } from "react-router-dom";

const ListPatients = () => {
  const handleEdit = (id) => {};
  const navigate = useNavigate();
  const [patients, setPatients] = useState([]);

  useEffect(() => {
    const getPatients = async () => {
      const response = await sendRequest({
        route: "/getPatients",
        method: "POST",
      });
      setPatients(response);
    };
    getPatients();
  });
  return (
    <div>
      {" "}
      <div className="cont-nav">
        <h1>Patients</h1>
        <Button text={"Add Patient"} onClick={() => navigate("/AddPatients")} />
      </div>
      <table className="table">
        <thead>
          <tr className="tr">
            <th>Name</th>
            <th>Gender</th>
            <th>Date of birth</th>
            <th>Medical History</th>
            <th>Contact</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          {patients.map((patients, index) => (
            <tr key={index}>
              <td>{patients.name}</td>
              <td>{patients.gender}</td>
              <td>{patients.DOB}</td>
              <td>{patients.medical_history}</td>
              <td>{patients.contact}</td>
              <td>
                <Button text={"Edit"} onClick={() => handleEdit(patients.id)} />
                <Button text={"Delete"} onClick={() => handleEdit(patients.id)} />
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default ListPatients;
