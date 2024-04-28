import { Route, Routes } from "react-router-dom";
import Home from "./pages/Home/Home";
import Login from "./pages/login/Login";
import Navbar from "./components/Navbar";
import Rent from "./pages/Rent/Rent";
import Return from "./pages/Return/Return";
import Penalties from "./pages/Penalties/Penalties";
import Register from "./pages/Register/Register";
import DetailRegister from "./pages/Register/DetailRegister/DetailRegister";
import RentDetail from "./pages/Rent/RentDetail/RentDetail";

function App() {
  return (
    <Routes>
      <Route path="/" element={<Navbar />}>
        <Route index element={<Home />} />
        <Route path="rent" element={<Rent />} />
        <Route path="rent/:id" element={<RentDetail />} />
        <Route path="return" element={<Return />} />
        <Route path="penalties" element={<Penalties />} />

        <Route path="register" element={<Register />} />
        <Route path="register/:id" element={<DetailRegister />} />
      </Route>
      <Route path="login" element={<Login />} />
    </Routes>
  );
}

export default App;
