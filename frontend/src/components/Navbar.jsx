/* eslint-disable react-hooks/exhaustive-deps */
import { Link, NavLink, Outlet, useNavigate } from "react-router-dom";
import { API_URL } from "../api";
import axios from "axios";
import toast, { Toaster } from "react-hot-toast";
import { useEffect } from "react";

const Navbar = () => {
  const navigate = useNavigate();
  const token = localStorage.getItem("token");

  const logout = async () => {
    try {
      const { data } = await axios.post(
        `${API_URL}/auth/logout`,
        {},
        // config
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );
      if (data) {
        toast.success(data.message);
        localStorage.removeItem("token");
        setTimeout(() => {
          navigate("/login");
        }, 1000);
      }
    } catch (error) {
      toast.error(error.response.data.message);
    }
  };

  useEffect(() => {
    if (!token) {
      toast.error("Login dahulu");
      setTimeout(() => {
        navigate("/login");
      }, 1000);
    }
  }, []);

  return (
    <>
      <Toaster position="top-center" reverseOrder={false} />
      <nav className="navbar navbar-expand-lg bg-body-tertiary">
        <div className="container-fluid">
          <NavLink className="navbar-brand fw-semibold" to={"/"}>
            Sewa Mobil
          </NavLink>
          <button
            className="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span className="navbar-toggler-icon"></span>
          </button>
          <div className="collapse navbar-collapse" id="navbarNav">
            <ul className="navbar-nav ms-auto">
              {/* NavLink adalah component bawaan dari react-router-dom */}
              <NavLink
                className={({ isActive }) =>
                  isActive ? "nav-link active" : "nav-link"
                }
                to={"/"}
              >
                Home
              </NavLink>
              <NavLink
                className={({ isActive }) =>
                  isActive ? "nav-link active" : "nav-link"
                }
                to={"/rent"}
              >
                Rent
              </NavLink>
              <NavLink
                className={({ isActive }) =>
                  isActive ? "nav-link active" : "nav-link"
                }
                to={"/return"}
              >
                Return
              </NavLink>
              <NavLink
                className={({ isActive }) =>
                  isActive ? "nav-link active" : "nav-link"
                }
                to={"/penalties"}
              >
                Penalties
              </NavLink>
              <NavLink
                className={({ isActive }) =>
                  isActive ? "nav-link active" : "nav-link"
                }
                to={"/register"}
              >
                Register
              </NavLink>
              {token ? (
                <button className="btn btn-danger" onClick={logout}>
                  Logout
                </button>
              ) : (
                <Link className="btn btn-primary" to={"/login"}>
                  Login
                </Link>
              )}
            </ul>
          </div>
        </div>
      </nav>
      <main>
        <Outlet />
      </main>
    </>
  );
};

export default Navbar;
