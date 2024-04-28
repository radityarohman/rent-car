/* eslint-disable react-hooks/exhaustive-deps */
import axios from "axios";
import { useState, useEffect } from "react";
import { API_URL } from "../../api";
import { useNavigate } from "react-router-dom";
import { Toaster, toast } from "react-hot-toast";
import loginImage from "../../assets/img/mclaren.jpg";

const Login = () => {
  const navigate = useNavigate();
  const [formData, setFormData] = useState({});
  const [loading, setLoading] = useState(false);

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = async (e) => {
    setLoading(true);
    e.preventDefault();

    try {
      const { data } = await axios.post(`${API_URL}/auth/login`, formData);
      if (data) {
        toast.success("Login berhasil");
        localStorage.setItem("token", data.token);
        setTimeout(() => {
          navigate("/");
        }, 1000);
      }
    } catch (error) {
      toast.error(error.response.data.message);
    }
    setLoading(false);
  };

  useEffect(() => {
    if (localStorage.getItem("token")) {
      navigate("/");
    }
  }, []);

  return (
    <>
      <Toaster position="top-center" reverseOrder={false} />
      <div className="container-fluid vh-100 w-full d-flex justify-content-center align-items-center w-full gap-5 p-0">
        <div className="w-50 px-5">
          <h1 className="">Login</h1>
          <form onSubmit={handleSubmit}>
            <div className="mb-3">
              <label htmlFor="exampleInputEmail1" className="form-label">
                Username
              </label>
              <input
                name="username"
                type="text"
                className="form-control"
                id="exampleInputEmail1"
                aria-describedby="emailHelp"
                onChange={handleChange}
                placeholder="Username"
              />
            </div>
            <div className="mb-3">
              <label htmlFor="exampleInputPassword1" className="form-label">
                Password
              </label>
              <input
                name="password"
                type="password"
                className="form-control"
                id="exampleInputPassword1"
                onChange={handleChange}
                placeholder="Password"
              />
            </div>
            <button
              type="submit"
              className="btn btn-primary w-100"
              disabled={loading}
            >
              {loading ? "loading..." : "Login"}
            </button>
          </form>
        </div>
        <div className="vh-100 w-50">
          <img
            src={loginImage}
            alt="mclaren"
            className="h-100 object-fit-cover w-100"
          />
        </div>
      </div>
    </>
  );
};

export default Login;
