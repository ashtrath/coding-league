import { cn } from '@/lib/utils';
import {
    FormControl,
    FormLabel,
    FormLabelProps,
    FormMessage,
    FormMessageProps,
} from '@radix-ui/react-form';
import { TextareaHTMLAttributes, type InputHTMLAttributes } from 'react';

const Input = ({
    className,
    type,
    ...props
}: InputHTMLAttributes<HTMLInputElement>) => {
    return (
        <FormControl asChild>
            <input
                type={type}
                className={cn(
                    'peer flex h-12 w-full gap-2.5 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-800 shadow-sm placeholder:text-gray-400 disabled:cursor-not-allowed disabled:opacity-50',
                    className,
                )}
                {...props}
            />
        </FormControl>
    );
};

const InputLabel = ({
    className,
    children,
    required,
    ...props
}: FormLabelProps & { required?: boolean }) => {
    return (
        <FormLabel
            className={cn(
                'text-sm font-semibold leading-none text-gray-800 peer-disabled:cursor-not-allowed peer-disabled:opacity-70',
                className,
            )}
            {...props}
        >
            {children}
            {required && <span className="font-semibold text-red-600">*</span>}
        </FormLabel>
    );
};

const InputMessage = ({
    name,
    match,
    className,
    children,
    ...props
}: FormMessageProps) => {
    if (!children) return;

    return (
        <FormMessage
            name={name}
            match={match}
            className={cn('text-sm font-medium text-red-600', className)}
            {...props}
        >
            {children}
        </FormMessage>
    );
};

const Textarea = ({
    className,
    ...props
}: TextareaHTMLAttributes<HTMLTextAreaElement>) => {
    return (
        <FormControl asChild>
            <textarea
                className={cn(
                    'flex w-full gap-2.5 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-800 shadow-sm placeholder:text-gray-400 disabled:cursor-not-allowed disabled:opacity-50',
                    className,
                )}
                {...props}
            ></textarea>
        </FormControl>
    );
};

export { Input, InputLabel, InputMessage, Textarea };
