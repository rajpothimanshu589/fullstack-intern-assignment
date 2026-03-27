import { useState } from "react";
import { useNavigate } from "react-router-dom";

function Register() {
  const navigate = useNavigate();

  // ✅ NEW STATES
  const [first_name, setFirstName] = useState("");
  const [last_name, setLastName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [role, setRole] = useState("user");

  const handleRegister = async () => {
    try {
      const res = await fetch("http://localhost:8080/register", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        // ✅ FIXED BODY
        body: JSON.stringify({
          first_name,
          last_name,
          email,
          password,
          role
        })
      });

      const data = await res.json();

      if (data.status !== 200) {
        alert(data.message);
        return;
      }

      alert("Registered Successfully");

      navigate("/");

    } catch (error) {
      console.error(error);
      alert("Error registering");
    }
  };

  return (
    <div className="d-flex justify-content-center align-items-center vh-100 bg-light">
      <div className="card p-4 shadow" style={{ width: "350px" }}>
        <h2 className="text-center mb-3">Register</h2>

        {/* ✅ FIRST NAME */}
        <input
          className="form-control mb-2"
          placeholder="First Name"
          onChange={(e) => setFirstName(e.target.value)}
        />

        {/* ✅ LAST NAME */}
        <input
          className="form-control mb-2"
          placeholder="Last Name"
          onChange={(e) => setLastName(e.target.value)}
        />

        <input
          className="form-control mb-2"
          placeholder="Email"
          onChange={(e) => setEmail(e.target.value)}
        />

        <input
          className="form-control mb-2"
          type="password"
          placeholder="Password"
          onChange={(e) => setPassword(e.target.value)}
        />

        <select
          className="form-control mb-3"
          onChange={(e) => setRole(e.target.value)}
        >
          <option value="user">User</option>
          <option value="teacher">Teacher</option>
        </select>

        <button className="btn btn-success w-100" onClick={handleRegister}>
          Register
        </button>

        <p className="mt-3 text-center">
          Already have an account?{" "}
          <span
            style={{ color: "blue", cursor: "pointer" }}
            onClick={() => navigate("/")}
          >
            Login
          </span>
        </p>
      </div>
    </div>
  );
}

export default Register;