import React, { useState, useEffect } from 'react';
import api from '../../services/api';
import StringMask from 'string-mask';
import './style.css';

export default function Detalhes({ history }) {
    const [empresa, setEmpresa] = useState('');
    const [socios, setSocios] = useState([]);
    const cnpjMask = new StringMask('000.000.000/0000-00');
    const cpfMask = new StringMask('000.000.000-00');

    useEffect(() => {
        async function loadEmpresa(id) {
            const response = await api.get(`/empresa/${id}`);
            setEmpresa(response.data);
        }

        let id = localStorage.getItem('id');
        loadEmpresa(id);
        loadSocios(id);
    }, []);

    async function loadSocios(id) {
        const response = await api.get(`/socios/empresa/${id}`);
        if (response.status !== 204) {
            setSocios(response.data);
        }
    }

    function handleVoltar(event) {
        event.preventDefault();
        history.push("/");
    }

    async function handleRemoverSocio(id) {
        api.delete(`/socio/${id}`);

        let socioIndex = socios.indexOf(socios.find(element => element.id === id));
        socios.splice(socioIndex, 1);

        let idEmpresa = localStorage.getItem('id');
        history.push("/detalhes", { idEmpresa });
    }

    return (
        <div className="container-fluid d-flex flex-column align-items-center mt-3 w-100">
            <h3 className="mb-3"><strong>Empresa</strong></h3>
            <table className="table table-hover">
                <thead>
                    <tr>
                        <th>RAZÃO SOCIAL</th>
                        <th>NOME FANTASIA</th>
                        <th>CNPJ</th>
                        <th>ATIVIDADE PRINCIPAL</th>
                        <th>DATA DE ABERTURA</th>
                        <th>SITUAÇÃO CADASTRAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{empresa.razaoSocial}</td>
                        <td>{empresa.nomeFantasia}</td>
                        <td>{cnpjMask.apply(empresa.cnpj)}</td>
                        <td>{empresa.atividadePrincipal}</td>
                        <td>{empresa.dataAbertura}</td>
                        <td>{empresa.situacaoCadastral === true ? "Ativa" : "Inativa"}</td>
                    </tr>
                </tbody>
            </table>

            <h3 className="mb-3"><strong>Sócios</strong></h3>
            <table className="table table-hover">
                <thead>
                    <tr>
                        <th>NOME COMPLETO</th>
                        <th>CPF</th>
                        <th>E-MAIL</th>
                        <th>SEXO</th>
                        <th>NASCIMENTO</th>
                    </tr>
                </thead>
                <tbody>
                    {
                        socios.map(socio => (
                            <tr key={socio.id} >
                                <td>{socio.nomeCompleto}</td>
                                <td>{cpfMask.apply(socio.cpf)}</td>
                                <td>{socio.email}</td>
                                <td>{socio.nascimento}</td>
                                <td>{socio.sexo}</td>
                                <td onClick={event => handleRemoverSocio(socio.id)}>
                                    <button type="button" className="btn btn-outline-danger btn-sm mt-1">Remover</button>
                                </td>
                            </tr>
                        ))
                    }
                </tbody>
            </table>

            <div className="form-group">
                <button type="button" onClick={handleVoltar} className="btn btn-outline-danger ml-2">Voltar</button>
            </div>
        </div >
    )
}
