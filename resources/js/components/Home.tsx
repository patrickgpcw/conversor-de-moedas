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
            <div>
                <input type="text" value={value} onChange={handleChange}/>
            </div>
            <div>
                <select value={base} onChange={handleBaseChange}>
                    <option value="BRL">BRL</option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                </select>
            </div>
            <div>
                <select value={to} onChange={handleToChange} >
                    <option value="BRL">BRL</option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option> 
                </select>
            </div>
            <button onClick={handleClick}>converter</button>
            <div>
                {result}
            </div>
        </div>
    );
};

export default Home;