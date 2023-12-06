import React, { useEffect, useState } from "react";
import { sendRequest } from "../../core/helpers/request";
import Button from "../Button";
import "./style.css";
import { useNavigate } from "react-router-dom";

const AssignRoom = () => {
  const [chosenPatient, setChosenPatient] = useState("");
  const [chosenRoom, setChosenRoom] = useState("");
  const [patients, setPatients] = useState([]);
  const [rooms, setRooms] = useState([]);
  const navigate = useNavigate();

  useEffect(() => {
    const getPatients = async () => {
      const response = await sendRequest({
        route: "/getPatients",
        method: "POST",
      });
      setPatients(response);
      console.log(response);
    };

    const getAvailableRooms = async () => {
      const response = await sendRequest({
        route: "/getAvailableRooms",
        method: "POST",
      });
      console.log(response);
      setRooms(response);
    };
    console.log(typeof chosenPatient);
    getPatients();
    getAvailableRooms();
  }, []);
  const handleAssignRegularRoom = () => {
    if (!chosenPatient || !chosenRoom) {
      console.error("Please select both patient and room.");
      return;
    }
    const response = sendRequest({
      body: {
        roomID: parseInt(chosenRoom),
        patientID: parseInt(chosenPatient),
      },
      route: "/assignPatientToRoom",
      method: "POST",
    });
    console.log(response);
  };
  const handleAssignEmergencyRoom = () => {
    if (!chosenPatient || !chosenRoom) {
      console.error("Please select both patient and room.");
      return;
    }
    const response = sendRequest({
      body: {
        roomID: parseInt(chosenRoom),
        patientID: parseInt(chosenPatient),
      },
      route: "/emergencyAdmission",
      method: "POST",
    });
    console.log(response);
  };
  const handleRoomChosen = (e) => {
    setChosenRoom(e.target.value);
  };

  const handlePatientSelect = (e) => {
    setChosenPatient(e.target.value);
  };

  return (
    <div>
      <div className="header">
        <h1>Assign Patient To patient</h1>
      </div>
      <div className="assignPatientToRoom">
        <div className="custom-dropdown">
          <label>Select Patient:</label>
          <select className="dropdown-select" onChange={handlePatientSelect} value={chosenPatient}>
            <option value="">Select patient</option>
            {patients.map((patient) => (
              <option key={patient.patientID} value={patient.patientID}>
                {patient.name}
              </option>
            ))}
          </select>
        </div>
        <div className="custom-dropdown">
          <label>Select Room:</label>
          <select className="dropdown-select" onChange={handleRoomChosen} value={chosenRoom}>
            <option value="">Select Room</option>
            {rooms.map((room) => (
              <option key={room.roomID} value={room.roomID}>
                {room.room_number}
              </option>
            ))}
          </select>
        </div>
      </div>
      <div className="submitButtons">
        <button className="submit" onClick={handleAssignRegularRoom}>
          Assign Regular Room
        </button>
        <button className="submit" onClick={handleAssignEmergencyRoom}>
          Assign Emergency Room
        </button>
      </div>
    </div>
  );
};

export default AssignRoom;
