import { Slot } from '@radix-ui/react-slot';
import { cva, type VariantProps } from 'class-variance-authority';

import { cn } from '@/lib/utils';
import { forwardRef } from 'react';

const buttonVariants = cva(
    'inline-flex items-center justify-center whitespace-nowrap rounded-lg text-base font-semibold transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50',
    {
        variants: {
            variant: {
                default: 'bg-brand text-white hover:bg-brand/90 shadow-sm',
                secondary:
                    'border border-gray-300 bg-white text-gray-900 hover:bg-gray-200 shadow-sm',
                link: 'text-gray-900 underline-offset-4 hover:underline',
                ghost: 'hover:bg-gray-100 hover:text-gray-900',
            },
            size: {
                default: 'h-[44px] px-4 py-2.5',
                sm: 'h-8 px-3.5 py-2',
                lg: 'h-[52px] px-[18px] py-2.5',
                xl: 'h-[60px] px-5 py-3',
                icon: 'size-10',
            },
        },
        defaultVariants: {
            variant: 'default',
            size: 'default',
        },
    },
);

interface ButtonProps
    extends React.ButtonHTMLAttributes<HTMLButtonElement>,
        VariantProps<typeof buttonVariants> {
    asChild?: boolean;
}

const Button = forwardRef<HTMLButtonElement, ButtonProps>(
    ({ className, variant, size, asChild = false, ...props }, ref) => {
        const Comp = asChild ? Slot : 'button';
        return (
            <Comp
                className={cn(buttonVariants({ variant, size, className }))}
                ref={ref}
                {...props}
            />
        );
    },
);
Button.displayName = 'Button';

export default Button;
