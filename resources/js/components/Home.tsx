import React, { useState } from "react";
import axios from "axios";

export interface IConvertResult {
    convert_result: number;
    quotation_used: number;
}

export interface IConvertResultError {
    value: Array<string>,
    base: Array<string>,
    to: Array<string>
}

const Home = () => {
    const [result, setResult] = useState<string>('');
    const [value, setValue] = useState<string>('1.20');
    const [base, setBase] = useState<string>('BRL');
    const [to, setTo] = useState<string>('USD');

    const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setValue(parseFloat(e.target.value).toFixed(2));
    }

    const handleBaseChange = (e:React.ChangeEvent<HTMLSelectElement>) => {
        setBase(e.target.value);
    }

    const handleToChange = (e:React.ChangeEvent<HTMLSelectElement>) => {
        setTo(e.target.value);
    }

    const handleClick = (e:React.MouseEvent<HTMLButtonElement>) => {
        axios.get('http://localhost:8000/api/converter', {
            params:{
                base,
                to,
                value,
            },
        }).then((result) => {
            const data = (result.data as IConvertResult);
            setResult(data.convert_result.toString());
        });
    }

    return (
        <div>
            <div className="container d-flex justify-content-center align-items-center" style={{height:"100vh"}}>
                <div className="card h-auto" style={{width:"20rem"}}>
                    <div className="card-body">
                        <div className="mb-3">
                            <label className="form-label">Digite o seu valor</label>
                            <input className="form-control" type="text" value={value} onChange={handleChange}/>
                        </div>
                        <div className="input-group mb-3">
                            <span className="input-group-text">De:</span>
                            <select className="form-select" value={base} onChange={handleBaseChange}>
                                <option value="BRL">BRL</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                            </select>
                        </div>
                        <div className="input-group mb-3">
                            <span className="input-group-text">Para:</span>
                            <select className="form-select" value={to} onChange={handleToChange} >
                                <option value="BRL">BRL</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option> 
                            </select>
                        </div>
                        <button className="btn btn-primary w-100" onClick={handleClick}>Converter</button>
                        <div className="d-flex justify-content-center my-3">
                            <strong>
                                {result || '-'}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Home;