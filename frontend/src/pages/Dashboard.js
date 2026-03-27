import { useNavigate } from "react-router-dom";

function UserDashboard() {
  const navigate = useNavigate();

  const user = JSON.parse(localStorage.getItem("user"));

  const handleLogout = () => {
    localStorage.clear();
    navigate("/");
  };

  return (
    <div style={{ padding: "20px" }}>
      <h1>Welcome {user?.email} 👋</h1>

      <hr />

      <h3>User Dashboard</h3>
      <p>This is your dashboard page.</p>

      <button onClick={handleLogout}>Logout</button>
    </div>
  );
}


export default UserDashboard;