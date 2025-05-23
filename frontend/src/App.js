import React, { useEffect, useState } from 'react';

function App() {
  const [estado, setEstado] = useState(null);

  useEffect(() => {
    fetch('http://localhost:3000/api/estado')
      .then(response => response.json())
      .then(data => setEstado(data))
      .catch(error => console.error('Error al conectar con el backend:', error));
  }, []);

  return (
    <div style={{ fontFamily: 'sans-serif', padding: '2rem' }}>
      <h1>Conexión Slim + React</h1>
      {estado ? (
        <pre>{JSON.stringify(estado, null, 2)}</pre>
      ) : (
        <p>Cargando estado del backend...</p>
      )}
    </div>
  );
}

export default App;
