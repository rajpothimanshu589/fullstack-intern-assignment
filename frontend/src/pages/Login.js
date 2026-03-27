import { useState } from "react";
import { useNavigate } from "react-router-dom";

function Login() {
  const navigate = useNavigate();

  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  const handleLogin = async () => {
  try {
    const res = await fetch("http://localhost:8080/login", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ email, password })
    });

    const data = await res.json();

    if (data.status !== 200) {
      alert(data.message);
      return;
    }

    // ✅ STORE DATA
localStorage.setItem("token", data.token);
localStorage.setItem("role", data.user.role);
localStorage.setItem("user", JSON.stringify(data.user));

localStorage.setItem("email", data.user.email);

// ✅ FIX HERE
localStorage.setItem("first_name", data.user.first_name);
localStorage.setItem("last_name", data.user.last_name);

   console.log("LOGIN RESPONSE:", data);
    // ✅ ROLE BASED REDIRECT
    if (data.user.role === "teacher") {
      navigate("/teacher");
    } else {
      navigate("/user");
    }

  } catch (error) {
    console.error(error);
    alert("Login error");
  }
};

  return (
    <div className="d-flex justify-content-center align-items-center vh-100 bg-light">
      <div className="card p-4 shadow" style={{ width: "350px" }}>
        <h2 className="text-center mb-3">Login</h2>

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

        <button className="btn btn-primary w-100" onClick={handleLogin}>
          Login
        </button>

        {/* 🔥 Register link */}
        <p className="mt-3 text-center">
          Don't have an account?{" "}
          <span
            style={{ color: "blue", cursor: "pointer" }}
            onClick={() => navigate("/register")}
          >
            Register
          </span>
        </p>
      </div>
    </div>
  );
}

export default Login;