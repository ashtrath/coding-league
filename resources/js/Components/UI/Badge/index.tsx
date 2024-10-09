import { cn } from '@/lib/utils';
import { cva, type VariantProps } from 'class-variance-authority';
import { type HTMLAttributes } from 'react';

const badgeVariants = cva(
    'inline-flex items-center rounded-full px-2 py-0.5 font-medium text-xs leading-[18px] focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2',
    {
        variants: {
            variant: {
                default: 'bg-red-50 text-brand hover:bg-red-50/90',
                secondary: 'bg-gray-100 text-gray-700 hover:bg-gray-100/90',
                info: 'bg-blue-50 text-blue-700 hover:bg-blue-50/90',
                success: 'bg-green-50 text-green-700 hover:bg-green-50/90',
                error: 'bg-red-50 text-red-700 hover:bg-red-50/90',
            },
        },
        defaultVariants: {
            variant: 'default',
        },
    },
);

interface BadgeProps
    extends HTMLAttributes<HTMLDivElement>,
        VariantProps<typeof badgeVariants> {}

const Badge = ({ className, variant, ...props }: BadgeProps) => {
    return (
        <div className={cn(badgeVariants({ variant }), className)} {...props} />
    );
};

export default Badge;
