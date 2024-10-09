import { cn } from '@/lib/utils';
import { type HTMLAttributes } from 'react';

const Card = ({ className, ...props }: HTMLAttributes<HTMLDivElement>) => {
    return (
        <div
            className={cn(
                'rounded-xl border border-gray-300 bg-white text-gray-900 shadow-sm',
                className,
            )}
            {...props}
        />
    );
};

const CardHeader = ({
    className,
    ...props
}: HTMLAttributes<HTMLDivElement>) => {
    return (
        <header
            className={cn('flex flex-col gap-y-1.5 p-6', className)}
            {...props}
        />
    );
};

const CardTitle = ({
    className,
    ...props
}: HTMLAttributes<HTMLHeadingElement>) => {
    return (
        <h3
            className={cn(
                'text-2xl font-semibold leading-none tracking-tight',
                className,
            )}
            {...props}
        />
    );
};

const CardDescription = ({
    className,
    ...props
}: HTMLAttributes<HTMLParagraphElement>) => {
    return <p className={cn('text-sm text-gray-500', className)} {...props} />;
};

const CardContent = ({
    className,
    ...props
}: HTMLAttributes<HTMLDivElement>) => {
    return <div className={cn('p-6 pt-0', className)} {...props} />;
};

const CardFooter = ({
    className,
    ...props
}: HTMLAttributes<HTMLDivElement>) => {
    return (
        <footer
            className={cn('flex items-center p-6 pt-0', className)}
            {...props}
        />
    );
};

export {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
};
