import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";

function TeacherDashboard() {
  const [teachers, setTeachers] = useState([]); // ✅ always array
  const [loading, setLoading] = useState(true); // ✅ loading state
  const navigate = useNavigate();

  const handleLogout = () => {
    localStorage.clear();
    navigate("/");
  };
useEffect(() => {
  const token = localStorage.getItem("token");

  fetch("http://localhost:8080/teachers", {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  })
    .then((res) => res.json())
    .then((data) => {
      console.log("API Response:", data);

      if (Array.isArray(data)) {
        setTeachers(data);
      } else if (Array.isArray(data.data)) {
        setTeachers(data.data);
      } else {
        setTeachers([]);
      }

      setLoading(false);
    })
    .catch((err) => {
      console.log(err);
      setTeachers([]);
      setLoading(false);
    });
}, []);

  return (
    <div className="container mt-4">
      <div className="d-flex justify-content-between">
        <h2>Teacher Dashboard 👨‍🏫</h2>
        <button className="btn btn-danger" onClick={handleLogout}>
          Logout
        </button>
      </div>

      <hr />

      {/* ✅ Loading State */}
      {loading ? (
        <p>Loading teachers...</p>
      ) : teachers.length === 0 ? (
        <p>No teachers found</p>
      ) : (
        <table className="table table-bordered">
          <thead>
  <tr>
    <th>ID</th>
    <th>Email</th>
    <th>Name</th>
    <th>University</th>
    <th>Year Joined</th>
  </tr>
</thead>

<tbody>
  {teachers.map((t, index) => (
    <tr key={t.id || index}>
      <td>{t.id}</td>
      <td>{t.email}</td>
      <td>{t.first_name} {t.last_name}</td>
      <td>{t.university_name}</td>
      <td>{t.year_joined}</td>
    </tr>
  ))}
</tbody>
        </table>
      )}
    </div>
  );
}

export default TeacherDashboard;