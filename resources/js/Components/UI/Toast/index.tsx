import {
    RiCheckboxCircleFill,
    RiCloseCircleFill,
    RiCloseLine,
    RiInformationFill,
} from '@remixicon/react';
import toast, { type Toast } from 'react-hot-toast';
import Button from '../Button';

interface ToastProps {
    t: Toast;
    type?: 'info' | 'success' | 'destructive';
    message: string;
}

const Toast = ({ type = 'info', message, t }: ToastProps) => {
    return (
        <div
            className={`flex w-full max-w-sm items-center gap-2 rounded-md border border-gray-300 bg-white p-4 text-gray-900 shadow-lg ${t.visible ? 'animate-in zoom-in-95 slide-in-from-top-2 fade-in-5' : 'animate-out fill-mode-forwards slide-out-to-top-2 fade-out-0'}`}
        >
            {type === 'success' && (
                <RiCheckboxCircleFill className="h-6 w-6 text-green-500" />
            )}
            {type === 'info' && (
                <RiInformationFill className="h-6 w-6 text-blue-500" />
            )}
            {type === 'destructive' && (
                <RiCloseCircleFill className="h-6 w-6 text-red-500" />
            )}
            <div className="flex-1">
                <p className="text-sm font-semibold">{message}</p>
            </div>
            <Button
                variant="secondary"
                size="icon"
                className="size-7"
                onClick={() => toast.dismiss(t.id)}
            >
                <RiCloseLine className="size-5" />
            </Button>
        </div>
    );
};

export const showToast = (
    message: string,
    type?: 'info' | 'success' | 'destructive',
) => {
    toast.custom((t) => <Toast type={type} message={message} t={t} />, {
        duration: 4000,
        position: 'top-center',
    });
};
