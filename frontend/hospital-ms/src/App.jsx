import "./styles/index.css";
import "./styles/utilities.css";
import "./styles/colors.css";
import LoginPage from "./pages/LoginPage";
import Admin from "./pages/Admin";
import { BrowserRouter, Routes, Route } from "react-router-dom";

const App = () => {
  return (
    <div className="flex center App">
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<LoginPage />} />
          <Route path="/admin" element={<Admin />} />
          {/* <Route path="/" element={<LandingPage />} />  */}
        </Routes>
      </BrowserRouter>
    </div>
  );
};

export default App;
