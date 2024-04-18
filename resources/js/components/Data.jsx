import React, { useEffect, useState } from 'react';
import axios from 'axios';
import ReactDOM from 'react-dom/client';

export default function Data() {
  const [planloads, setPlanloads] = useState([]);
  const [containers, setContainers] = useState([]);

  const title = "AIS ONLINE";

  // useEffect(() => {
  //   axios.get('/get-processload')
  //     .then(response => {

  //       console.log(response);
  //       setPlanloads(response.data);

  //       axios.get('/get-containers')
  //         .then(response => {
  //           setContainers(response.data);
  //         })
  //         .catch(error => {
  //           console.error(error);
  //         });
  //     })
  //     .catch(error => {
  //       console.error(error);
  //     });
  // }, []);

  console.log(containers);

  return (
    <div>
      DATAAA
    </div>
  );
}


const root = ReactDOM.createRoot(document.getElementById("Data"));

console.log(root);
root.render(
  <React.StrictMode>
    <Data />
  </React.StrictMode>
);
