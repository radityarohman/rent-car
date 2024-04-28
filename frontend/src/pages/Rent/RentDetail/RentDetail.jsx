/* eslint-disable react-hooks/exhaustive-deps */
import axios from "axios";
import { useEffect, useState } from "react";
import { API_URL } from "../../../api";
import toast from "react-hot-toast";
import { useNavigate, useParams } from "react-router-dom";

const RentDetail = () => {
  const token = localStorage.getItem("token");
  const navigate = useNavigate();
  const { id } = useParams();

  const [formData, setFormData] = useState({
    tenant: "",
    no_car: "",
    date_borrow: "",
    date_return: "",
    down_payment: "",
    discount: "",
    total: "",
  });

  const fetchData = async () => {
    try {
      const { data } = await axios.get(`${API_URL}/rent/${id}`, {
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

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const { data } = await axios.post(`${API_URL}/rent/${id}`, formData, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      if (data) {
        toast.success(data.message);
        setTimeout(() => {
          navigate("/rent");
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
    <>
      <div className="container">
        <h1 className="my-3 text-center">Edit Rent Data</h1>
        <div className="w-50 m-auto">
          <form action="" onSubmit={handleSubmit}>
            <div className="form-group mb-3">
              <label htmlFor="tenant">Tenant:</label>
              <input
                type="text"
                className="form-control"
                id="tenant"
                name="tenant"
                value={formData.tenant}
                onChange={handleChange}
              />
            </div>
            <div className="form-group mb-3">
              <label htmlFor="no_car">No Car:</label>
              <input
                type="text"
                className="form-control"
                id="no_car"
                name="no_car"
                value={formData.no_car}
                onChange={handleChange}
              />
            </div>
            <div className="form-group mb-3">
              <label htmlFor="date_borrow">No KTP:</label>
              <input
                type="text"
                className="form-control"
                id="date_borrow"
                name="date_borrow"
                value={formData.date_borrow}
                onChange={handleChange}
              />
            </div>
            <div className="form-group mb-3">
              <label htmlFor="date_return">Date Return:</label>
              <input
                type="text"
                className="form-control"
                id="date_return"
                name="date_return"
                value={formData.date_return}
                onChange={handleChange}
              />
            </div>
            <div className="form-group mb-3">
              <label htmlFor="date_of_birth">Down Payment:</label>
              <input
                type="text"
                className="form-control"
                id="down_payment"
                name="down_payment"
                value={formData.down_payment}
                onChange={handleChange}
              />
            </div>
            <div className="form-group mb-3">
              <label htmlFor="email">Discount:</label>
              <input
                type="text"
                className="form-control"
                id="discount"
                name="discount"
                value={formData.discount}
                onChange={handleChange}
              />
            </div>
            <div className="form-group mb-3">
              <label htmlFor="phone">Total:</label>
              <input
                type="text"
                className="form-control"
                id="total"
                name="total"
                value={formData.total}
                onChange={handleChange}
              />
            </div>
            <button type="submit" className="btn btn-primary w-full mb-3">
              Submit
            </button>
          </form>
        </div>
      </div>
    </>
  );
};

export default RentDetail;
