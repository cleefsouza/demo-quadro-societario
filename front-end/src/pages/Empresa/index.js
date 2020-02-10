import React, { useState } from 'react';
import api from '../../services/api';
import './style.css';

export default function Empresa({ history }) {
    const [razaoSocial, setRazaoSocial] = useState('');
    const [nomeFantasia, setNomeFantasia] = useState('');
    const [cnpj, setCnpj] = useState('');
    const [atividadePrincipal, setAtividade] = useState('');
    const [dataAbertura, setDataAbertura] = useState('');
    const [situacao, setSituacao] = useState('');

    async function handleSubmit(event) {
        event.preventDefault();

        let situacaoCadastral = situacao === 1 ? true : false;

        await api.post('/empresa', {
            razaoSocial,
            nomeFantasia,
            cnpj,
            atividadePrincipal,
            dataAbertura,
            situacaoCadastral
        });

        history.push("/");
    }

    function handleCancelar(event) {
        event.preventDefault();
        history.push("/");
    }

    return (
        <div className="container-fluid d-flex flex-column align-items-center mt-3 w-100">
            <h3 className="mb-3">Cadastro de Empresas</h3>
            <form className="form-empresa" onSubmit={handleSubmit}>
                <div className="form-group">
                    <label htmlFor="empresa">RAZÃO SOCIAL *</label>
                    <input
                        type="text"
                        name="empresa"
                        id="empresa"
                        required
                        value={razaoSocial}
                        className="form-control"
                        onChange={event => setRazaoSocial(event.target.value)}
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="nome-fantasia">NOME FANTÁSIA *</label>
                    <input
                        type="text"
                        name="nome-fantasia"
                        id="nome-fantasia"
                        required
                        value={nomeFantasia}
                        className="form-control"
                        onChange={event => setNomeFantasia(event.target.value)}
                    />
                </div>

                <div className="form-group">
                    <label htmlFor="cnpj">CNPJ * <span className="small">(apenas números)</span></label>
                    <input
                        type="text"
                        name="cnpj"
                        id="cnpj"
                        value={cnpj}
                        minLength="14"
                        maxLength="14"
                        className="form-control"
                        required
                        onChange={event => setCnpj(event.target.value)}
                    />
                </div>

                <div className="form-group">
                    <label htmlFor="atividade-principal">ATIVIDADE PRINCIPAL *</label>
                    <textarea
                        name="atividade-principal"
                        id="atividade-principal"
                        value={atividadePrincipal}
                        className="form-control"
                        required
                        onChange={event => setAtividade(event.target.value)}
                    />
                </div>

                <div className="form-group">
                    <label htmlFor="data-abertura">DATA ABERTURA *</label>
                    <input
                        type="date"
                        name="data-abertura"
                        id="data-abertura"
                        value={dataAbertura}
                        required
                        className="form-control"
                        onChange={event => setDataAbertura(event.target.value)}
                    />
                </div>

                <div className="form-group">
                    <label htmlFor="situacao-cadastral">SITUAÇÃO CADASTRAL *</label>
                    <select
                        name="situacao-cadastral"
                        id="situacao-cadastral"
                        className="form-control"
                        value={situacao}
                        required
                        onChange={event => setSituacao(event.target.value)}
                    >
                        <option value="" disabled>Selecione ...</option>
                        <option value={true}>ATIVA</option>
                        <option value={false}>INATIVA</option>
                    </select>
                </div>

                <div className="form-group">
                    <button type="submit" className="btn btn-outline-success">Confirmar</button>
                    <button type="button" onClick={handleCancelar} className="btn btn-outline-danger ml-2">Cancelar</button>
                </div>
            </form>
        </div>
    )
}
