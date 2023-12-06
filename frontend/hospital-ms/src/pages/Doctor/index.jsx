import React, { useEffect, useState } from "react";
import "./style.css";
import Button from "../../components/Button";
import Navbar from "../../components/Navbar";
import ListDoctors from "../../components/ListDoctors";
import ListPatients from "../../components/ListPatients";
import AssignRoom from "../../components/AssignRoom";
const Admin = () => {
  const [section, setSection] = useState("doctors");
  useEffect(() => {});
  return (
    <div className="container">
      <Navbar />
      <div className="body-content">
        <div className="options">
          <Button text={"List Doctors"} onClick={() => setSection("doctors")} />
          <Button text={"List Patients"} onClick={() => setSection("patients")} />
          <Button text={"Assign Patient to room"} onClick={() => setSection("assign")} />
        </div>
        {section === "doctors" && <ListDoctors />}
        {section === "patients" && <ListPatients />}
        {section === "assign" && <AssignRoom />}
      </div>
    </div>
  );
};

export default Admin;
