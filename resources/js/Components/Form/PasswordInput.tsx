import { RiEyeCloseLine, RiEyeLine } from '@remixicon/react';
import { type InputHTMLAttributes, useState } from 'react';
import { Input } from '../UI/Input';

const PasswordInput = ({
    value,
    onChange,
    ...props
}: InputHTMLAttributes<HTMLInputElement>) => {
    const [type, setType] = useState('password');
    const Icon = type === 'password' ? RiEyeLine : RiEyeCloseLine;

    const handleToggle = () => {
        setType((prevType) => (prevType === 'password' ? 'text' : 'password'));
    };

    return (
        <div className="flex">
            <Input
                type={type}
                value={value}
                onChange={onChange}
                className="pr-12"
                {...props}
            />
            <button
                className="flex items-center justify-around"
                type="button"
                onClick={handleToggle}
                tabIndex={-1}
            >
                <Icon className="absolute mr-12 size-6 text-gray-400" />
            </button>
        </div>
    );
};

export default PasswordInput;
