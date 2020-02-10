import React, { useState, useEffect } from 'react';
import api from '../../services/api';
import './style.css';

export default function Socio({ history }) {
    const [nomeCompleto, setNomeCompleto] = useState('');
    const [cpf, setCpf] = useState('');
    const [email, setEmail] = useState('');
    const [sexo, setSexo] = useState('');
    const [nascimento, setNascimento] = useState('');
    const [empresa, setEmpresaId] = useState('');
    const [selectEmpresas, setSelectEmpresas] = useState([]);

    async function handleSubmit(event) {
        event.preventDefault();

        let empresaId = parseInt(empresa);

        await api.post('/socio', {
            nomeCompleto,
            cpf,
            email,
            sexo,
            nascimento,
            empresaId
        });

        history.push("/");
    }

    function handleCancelar(event) {
        event.preventDefault();
        history.push("/");
    }

    useEffect(() => {
        async function loadEmpresas() {
            const response = await api.get('/empresas');
            setSelectEmpresas(response.data);
        }

        loadEmpresas();
    }, []);

    return (
        <div className="container-fluid d-flex flex-column align-items-center mt-3 w-100">
            <h3 className="mb-3">Cadastro de Sócios</h3>
            <form className="form-socio" onSubmit={handleSubmit}>
                <div className="form-group">
                    <label htmlFor="nomeCompleto">NOME COMPLETO *</label>
                    <input
                        type="text"
                        name="nomeCompleto"
                        id="nomeCompleto"
                        value={nomeCompleto}
                        required
                        className="form-control"
                        onChange={event => setNomeCompleto(event.target.value)}
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="cpf">CPF *  <span className="small">(apenas números)</span></label>
                    <input
                        type="text"
                        name="cpf"
                        id="cpf"
                        maxLength="11"
                        minLength="11"
                        value={cpf}
                        required
                        className="form-control"
                        onChange={event => setCpf(event.target.value)}
                    />
                </div>

                <div className="form-group">
                    <label htmlFor="email">E-MAIL *</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value={email}
                        className="form-control"
                        onChange={event => setEmail(event.target.value)}
                    />
                </div>

                <div className="form-group">
                    <label htmlFor="nascimento">NASCIMENTO *</label>
                    <input
                        type="date"
                        name="nascimento"
                        id="nascimento"
                        value={nascimento}
                        required
                        className="form-control"
                        onChange={event => setNascimento(event.target.value)}
                    />
                </div>

                <div className="form-group">
                    <label htmlFor="sexo">SEXO</label>
                    <select
                        name="sexo"
                        id="sexo"
                        className="form-control"
                        value={sexo}
                        onChange={event => setSexo(event.target.value)}
                    >
                        <option value={"Masculino"}>Masculino</option>
                        <option value={"Feminino"}>Feminino</option>
                    </select>
                </div>

                <div className="form-group">
                    <label htmlFor="empresa">EMPRESA *</label>
                    <select
                        name="empresa"
                        id="empresa"
                        className="form-control"
                        value={empresa}
                        required
                        onChange={event => setEmpresaId(event.target.value)}
                    >
                        {
                            selectEmpresas.map(empresa => (
                                <option key={empresa.id} value={empresa.id}>{empresa.nomeFantasia}</option>
                            ))
                        }
                    </select>
                </div>

                <div className="form-group">
                    <button type="submit" className="btn btn-success">Confirmar</button>
                    <button type="button" onClick={handleCancelar} className="btn btn-danger ml-2">Cancelar</button>
                </div>
            </form>
        </div>
    )
}
