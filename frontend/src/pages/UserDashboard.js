import { useNavigate } from "react-router-dom";

function UserDashboard() {
  const navigate = useNavigate();

  const email = localStorage.getItem("email");
  const first_name = localStorage.getItem("first_name");
  const last_name = localStorage.getItem("last_name");

  const name = first_name && last_name 
    ? `${first_name} ${last_name}` 
    : "User";

  const handleLogout = () => {
    localStorage.clear();
    navigate("/");
  };

  return (
    <div className="container mt-4">
      <div className="d-flex justify-content-between align-items-center">
        <h2>Welcome {name} 👋</h2>
        <button className="btn btn-danger" onClick={handleLogout}>
          Logout
        </button>
      </div>

      <hr />

      <div className="card p-4 shadow-sm mb-4">
        <p><strong>Name:</strong> {name}</p>
        <p><strong>Email:</strong> {email}</p>
      </div>
    </div>
  );
}

export default UserDashboard;