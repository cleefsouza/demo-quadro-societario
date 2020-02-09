import React, { useEffect, useState } from 'react';
import api from '../../services/api';
import StringMask from 'string-mask';

export default function Dashboard() {
    const [empresas, setEmpresas] = useState([]);
    const cnpjMask = new StringMask('00.000.000/0000-00');

    useEffect(() => {
        async function loadEmpresas() {
            const response = await api.get('/empresas');
            setEmpresas(response.data);
        }

        loadEmpresas();
    }, []);

    function smallAtividade(value) {
        if (value.length >= 27) {
            value = value.slice(0, 24) + " ...";
        }

        return value
    }

    return (
        <>
            <h1 className="pt-3">Quadro Societário</h1>
            <p className="text-danger small">
                * Clique no card da empresa desejada para uma visão mais detalhada.
            </p>
            <div className="contanier-fluid container-cards d-flex flex-row flex-wrap">
                {
                    empresas.map(empresa => (
                        <div key={empresa.id} className="card" data-toggle="modal" data-target="#modalEmpresa">
                            <div className="card-body mt-4">
                                <h3 className="text-center font-weight-bold text-justify mb-3">
                                    {empresa.nomeFantasia}
                                </h3>
                                <p className="text-center" id="atividade-principal">
                                    {smallAtividade(empresa.atividadePrincipal)}
                                </p>
                                <label>
                                    <strong>CNPJ:</strong> {cnpjMask.apply(empresa.cnpj)}
                                </label><br />
                                <label>
                                    <strong>Data Abertura:</strong> {empresa.dataAbertura}
                                </label><br />
                                <label>
                                    <strong>Situação Cadastral:</strong>
                                    <span className="badge badge-dark ml-1">
                                        {empresa.situacaoCadastral === true ? 'Ativa' : 'Desativada'}
                                    </span>
                                </label>
                            </div>
                        </div>
                    ))
                }
            </div>
        </>
    )
}