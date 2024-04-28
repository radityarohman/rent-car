/* eslint-disable react-hooks/exhaustive-deps */
import axios from "axios";
import { API_URL } from "../../api";
import toast from "react-hot-toast";
import { Link, useNavigate } from "react-router-dom";
import { useEffect, useState } from "react";
import { confirmDelete } from "../../utils/Swal";

const Rent = () => {
  const token = localStorage.getItem("token");
  const navigate = useNavigate();
  const [rentData, setRentData] = useState([]);
  const [loading, setLoading] = useState(false);

  const fetchData = async () => {
    setLoading(true);
    try {
      const { data } = await axios.get(`${API_URL}/rent`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      if (data) {
        setRentData(data.data);
      }
    } catch (error) {
      toast.error(error.response.data.message);
    }
    setLoading(false);
  };

  const handleDelete = async (id) => {
    try {
      const { data } = await axios.delete(`${API_URL}/return/${id}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      if (data) {
        toast.success(data.message);
        setTimeout(() => {
          navigate("/register");
        }, 1000);
        fetchData();
      }
    } catch (error) {
      console.log(error);
      toast.error(error.response.data.message);
    }
  };

  useEffect(() => {
    fetchData();
  }, []);

  return (
    <>
      <div className="container">
        {loading ? (
          <div>Loading...</div>
        ) : (
          <div>
            <header>
              <h1>Return Car Data</h1>
            </header>
            <table className="table table-striped border">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Tenant</th>
                  <th scope="col">Date Borrow</th>
                  <th scope="col">Date Return</th>
                  <th scope="col">Total</th>
                  <th scope="col" className="text-center">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                {rentData.length > 0 ? (
                  rentData.map((item, index) => (
                    <tr key={index}>
                      <th scope="row">{index + 1}</th>
                      <td>{item.tenant}</td>
                      <td>{item.date_borrow}</td>
                      <td>{item.date_return}</td>
                      <td>{item.total}</td>
                      <td className="text-center">
                        <Link
                          className="me-2 btn btn-warning"
                          to={`/return/${item.id}`}
                        >
                          Edit
                        </Link>
                        <button
                          className="btn btn-danger"
                          onClick={() =>
                            confirmDelete(() => handleDelete(item.id))
                          }
                        >
                          Delete
                        </button>
                      </td>
                    </tr>
                  ))
                ) : (
                  <tr>
                    <td colSpan={6}>No Data</td>
                  </tr>
                )}
              </tbody>
            </table>
          </div>
        )}
      </div>
    </>
  );
};

export default Rent;
