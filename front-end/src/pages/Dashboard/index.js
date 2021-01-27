import React, { useEffect, useState } from 'react';
import api from '../../services/api';
import StringMask from 'string-mask';
import './style.css';

export default function Dashboard({ history }) {
    const [empresas, setEmpresas] = useState([]);
    const cnpjMask = new StringMask('00.000.000/0000-00');

    useEffect(() => {
        async function loadEmpresas() {
            const response = await api.get('/empresas');
            if (response.status !== 204) {
                setEmpresas(response.data);
            }
        }

        loadEmpresas();
    }, []);

    function smallAtividade(value) {
        if (value.length >= 27) {
            value = value.slice(0, 24) + " ...";
        }

        return value
    }

    function handleNovaEmpresa() {
        history.push("/empresa");
    }

    function handleNovoSocio() {
        history.push("/socio");
    }

    function handleDetalhesEmpresa(id) {
        localStorage.setItem('id', id);
        history.push("/detalhes", { id });
    }

    function handleDeleteEmpresa(id) {
        api.delete(`/empresa/${id}`);

        let empresaIndex = empresas.indexOf(empresas.find(element => element.id === id));
        empresas.splice(empresaIndex, 1);

        history.push("/");
    }

    return (
        <>
            <button type="button" className="btn btn-outline-primary mr-2" onClick={handleNovaEmpresa}>Nova Empresa</button>
            <button type="button" className="btn btn-outline-primary" disabled={0 === empresas.length ? true : false} onClick={handleNovoSocio}>Novo Sócio</button>
            <p className="text-danger small mt-3">
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
                                        {!empresa.situacaoCadastral ? 'Inativa' : 'Ativa'}
                                    </span>
                                </label><br />

                                <button type="button" onClick={event => handleDetalhesEmpresa(empresa.id)} className="btn btn-outline-warning btn-sm mt-1 mr-2">Detalhes</button>
                                <button type="button" onClick={event => handleDeleteEmpresa(empresa.id)} className="btn btn-outline-danger btn-sm mt-1">Remover</button>
                            </div>
                        </div>
                    ))
                }
            </div>
        </>
    )
}