import { cn } from '@/lib/utils';
import {
    type HTMLAttributes,
    type TdHTMLAttributes,
    type ThHTMLAttributes,
} from 'react';

const Table = ({ className, ...props }: HTMLAttributes<HTMLTableElement>) => {
    return (
        <div className="relative w-full overflow-auto">
            <table
                className={cn('w-full text-sm text-gray-900', className)}
                {...props}
            />
        </div>
    );
};

const TableHeader = ({
    className,
    ...props
}: HTMLAttributes<HTMLTableSectionElement>) => {
    return (
        <thead className={cn('h-16 [&_tr]:border-b', className)} {...props} />
    );
};

const TableBody = ({
    className,
    ...props
}: HTMLAttributes<HTMLTableSectionElement>) => {
    return (
        <tbody
            className={cn(
                'text-base [&_tr:last-child]:border-0 odd:[&_tr]:bg-gray-50/70',
                className,
            )}
            {...props}
        />
    );
};

const TableFooter = ({
    className,
    ...props
}: HTMLAttributes<HTMLTableSectionElement>) => (
    <tfoot
        className={cn(
            'border-t bg-gray-50 font-medium [&>tr]:last:border-b-0',
            className,
        )}
        {...props}
    />
);

const TableRow = ({
    className,
    ...props
}: HTMLAttributes<HTMLTableRowElement>) => (
    <tr
        className={cn(
            'border-b transition-colors hover:bg-gray-50 data-[state=selected]:bg-gray-50',
            className,
        )}
        {...props}
    />
);

const TableHead = ({
    className,
    ...props
}: ThHTMLAttributes<HTMLTableCellElement>) => (
    <th
        className={cn(
            'h-12 px-4 text-left align-middle text-sm font-semibold text-gray-900 [&:has([role=checkbox])]:pr-0',
            className,
        )}
        {...props}
    />
);

const TableCell = ({
    className,
    ...props
}: TdHTMLAttributes<HTMLTableCellElement>) => (
    <td
        className={cn(
            'p-4 align-middle [&:has([role=checkbox])]:pr-0',
            className,
        )}
        {...props}
    />
);

export {
    Table,
    TableBody,
    TableCell,
    TableFooter,
    TableHead,
    TableHeader,
    TableRow,
};
