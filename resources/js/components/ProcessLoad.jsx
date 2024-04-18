import React, { useEffect, useState } from 'react';
import axios from 'axios';
import ReactDOM from 'react-dom/client';

export default function ProcessLoad() {
  const [planloads, setPlanloads] = useState([]);
  const [containers, setContainers] = useState([]);

  const title = "AIS ONLINE";

  useEffect(() => {
    axios.get('/get-processload')
      .then(response => {

        console.log(response);
        setPlanloads(response.data);

        axios.get('/get-containers')
          .then(response => {
            setContainers(response.data);
          })
          .catch(error => {
            console.error(error);
          });
      })
      .catch(error => {
        console.error(error);
      });
  }, []);

  console.log(containers);

  return (
    <div className="col-12">
      <div className="portlet">
        <div className="portlet-header portlet-header-bordered">
          <h3 className="portlet-title">{title}</h3>
        </div>
        <div className="portlet-body">
          <div className="table-responsive">
            <table id="processload" className="align-top table mb-0 table-bordered table-striped table-hover autosize">
              <thead className="text-nowrap">
                <tr>
                  <th>No</th>
                  <th>Status</th>
                  <th></th>
                  <th>Vessel</th>
                  <th>Vessel-Code</th>
                  <th>Shipping Company</th>
                  <th>Activity</th>
                  <th>POL</th>
                  <th className="align-top"> Jumlah Kontainer :</th>
                </tr>
              </thead>
              <tbody>
                {planloads.data?.map((planload, index) => (
                  <tr key={index}>
                    <td>{index + 1}</td>
                    <td className="align-middle text-nowrap">
                      {planload.status === 'Process-Load' && (
                        <>
                          <i className="marker marker-dot text-success"></i>
                          {planload.status}
                        </>
                      )}
                      {planload.status === 'Plan-Load' && (
                        <>
                          <i className="marker marker-dot text-warning"></i>
                          {planload.status}
                        </>
                      )}
                      {(planload.status === 'Realisasi' || planload.status === 'Default') && (
                        <>
                          <i className="marker marker-dot text-danger"></i>
                          Realisasi
                        </>
                      )}
                    </td>
                    <td className="text-center text-nowrap">
                      <a href={`/processload-create/${planload.slug}`} target="_blank" className="btn btn-success btn-sm">
                        Process Load <i className="fa fa-pencil"></i>
                      </a>
                    </td>
                    <td>{planload.vessel}</td>
                    <td>{planload.vessel_code}</td>
                    <td>{planload.select_company}</td>
                    <td>{planload.activity}</td>
                    <td>{planload.pol}</td>
                    <td align="top" valign="top">
                      <b>{containers?.filter(container => container.job_id === planload.id).length} Kontainer</b>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  );
}


if (document.getElementById('processLoadComponent')) {
  const root = ReactDOM.createRoot(document.getElementById("processLoadComponent"));
  root.render(
    <React.StrictMode>
      <ProcessLoad />
    </React.StrictMode>
  );
}