import React, { useEffect, useState } from "react";
import { sendRequest } from "../core/helpers/request";
import Button from "./Button";
import { useNavigate } from "react-router-dom";

const ListDoctors = () => {
  const handleEdit = (id) => {
    navigate(`/editDoctor/${id}`);
  };
  const navigate = useNavigate();
  const [doctors, setDoctors] = useState([]);

  useEffect(() => {
    const getDoctors = async () => {
      const response = await sendRequest({
        route: "/getDoctors",
        method: "POST",
      });
      setDoctors(response);
    };
    getDoctors();
  });
  return (
    <div>
      {" "}
      <div className="cont-nav">
        <h1>Doctors</h1>
        <Button text={"Add Doctor"} onClick={() => navigate("/AddDoctor")} />
      </div>
      <table className="table">
        <thead>
          <tr className="tr">
            <th>Name</th>
            <th>Specialization</th>
            <th>Contact</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          {doctors.map((doctor, index) => (
            <tr key={index}>
              <td>{doctor.name}</td>
              <td>{doctor.specialization}</td>
              <td>{doctor.contact_info}</td>
              <td>
                {/* Edit button */}
                <Button text={"Edit"} onClick={() => navigate(`/editdoctor/${doctor.userID}`)} />
                <Button text={"Delete"} onClick={() => navigate(`/deletedoctor/${doctor.userID}`)} />
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default ListDoctors;
