import "./styles/index.css";
import "./styles/utilities.css";
import "./styles/colors.css";
import LoginPage from "./pages/LoginPage";
import Admin from "./pages/Admin";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Doctor from "./pages/Doctor";
import Patient from "./pages/Patient";
import EditDoctor from "./components/EditDoctor";
const App = () => {
  return (
    <div className="App">
      <BrowserRouter>
        <div className="body">
          <Routes>
            <Route path="/" element={<LoginPage />} />
            <Route path="/admin" element={<Admin />} />
            <Route path="/doctor" element={<Doctor />} />
            <Route path="/patient" element={<Patient />} />
            <Route path="/editdoctor/:id" element={<EditDoctor />} />
          </Routes>
        </div>
      </BrowserRouter>
    </div>
  );
};

export default App;
