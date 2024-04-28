/* eslint-disable react-hooks/exhaustive-deps */
import axios from "axios";
import { useEffect, useState } from "react";
import { API_URL } from "../../../api";
import toast from "react-hot-toast";
import { useNavigate, useParams } from "react-router-dom";

const DetailRegister = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const token = localStorage.getItem("token");

  const [formData, setFormData] = useState({
    name: "",
    email: "",
    username: "",
    password: "",
    no_ktp: "",
    phone: "",
    date_of_birth: "",
    description: "",
  });

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const fetchData = async () => {
    try {
      const { data } = await axios.get(`${API_URL}/register/${id}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      if (data) {
        setFormData(data.data);
      }
    } catch (error) {
      toast.error(error.response.data.message);
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const { data } = await axios.put(`${API_URL}/register/${id}`, formData, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      if (data) {
        toast.success(data.message);
        setTimeout(() => {
          navigate("/register");
        }, 1000);
      }
    } catch (error) {
      toast.error(error.response.data.message);
    }
  };

  useEffect(() => {
    fetchData();
  }, [id]);

  return (
    <div className="container">
      <h1 className="my-3 text-center">Edit Data User</h1>
      <div className="w-50 m-auto">
        <form action="" onSubmit={handleSubmit}>
          <div className="form-group mb-3">
            <label htmlFor="username">Username:</label>
            <input
              type="text"
              className="form-control"
              id="username"
              name="username"
              value={formData.username}
              onChange={handleChange}
            />
          </div>
          <div className="form-group mb-3">
            <label htmlFor="password">Password:</label>
            <input
              type="password"
              className="form-control"
              id="password"
              name="password"
              value={formData.password}
              onChange={handleChange}
            />
          </div>
          <div className="form-group mb-3">
            <label htmlFor="no_ktp">Nomor KTP:</label>
            <input
              type="text"
              className="form-control"
              id="no_ktp"
              name="no_ktp"
              value={formData.no_ktp}
              onChange={handleChange}
            />
          </div>
          <div className="form-group mb-3">
            <label htmlFor="name">Name:</label>
            <input
              type="text"
              className="form-control"
              id="name"
              name="name"
              value={formData.name}
              onChange={handleChange}
            />
          </div>
          <div className="form-group mb-3">
            <label htmlFor="date_of_birth">Date of Birth:</label>
            <input
              type="date"
              className="form-control"
              id="date_of_birth"
              name="date_of_birth"
              value={formData.date_of_birth}
              onChange={handleChange}
            />
          </div>
          <div className="form-group mb-3">
            <label htmlFor="email">Email:</label>
            <input
              type="email"
              className="form-control"
              id="email"
              name="email"
              value={formData.email}
              onChange={handleChange}
            />
          </div>
          <div className="form-group mb-3">
            <label htmlFor="phone">Nomor Telepon:</label>
            <input
              type="text"
              className="form-control"
              id="phone"
              name="phone"
              value={formData.phone}
              onChange={handleChange}
            />
          </div>
          <div className="form-group mb-3">
            <label htmlFor="description">Deskripsi:</label>
            <textarea
              className="form-control"
              id="description"
              name="description"
              rows="3"
              value={formData.description}
              onChange={handleChange}
            ></textarea>
          </div>
          <button type="submit" className="btn btn-primary w-full mb-3">
            Submit
          </button>
        </form>
      </div>
    </div>
  );
};

export default DetailRegister;
