import { cn } from '@/lib/utils';
import { flexRender, type Table as TanstackTable } from '@tanstack/react-table';
import { type HTMLAttributes } from 'react';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '../Table';
import { DataTablePagination } from './DataTablePagination';

interface DataTableProps<TData> extends HTMLAttributes<HTMLDivElement> {
    table: TanstackTable<TData>;
}

export function DataTable<TData>({
    table,
    children,
    className,
    ...props
}: DataTableProps<TData>) {
    return (
        <div className={cn('w-full space-y-6', className)} {...props}>
            {children}
            <div className="overflow-hidden rounded-xl border border-gray-300 bg-white shadow-md">
                <Table>
                    <TableHeader>
                        {table.getHeaderGroups().map((headerGroup) => (
                            <TableRow key={headerGroup.id}>
                                {headerGroup.headers.map((header) => {
                                    return (
                                        <TableHead
                                            key={header.id}
                                            colSpan={header.colSpan}
                                        >
                                            {header.isPlaceholder
                                                ? null
                                                : flexRender(
                                                      header.column.columnDef
                                                          .header,
                                                      header.getContext(),
                                                  )}
                                        </TableHead>
                                    );
                                })}
                            </TableRow>
                        ))}
                    </TableHeader>
                    <TableBody>
                        {table.getRowModel().rows?.length ? (
                            table.getRowModel().rows.map((row) => (
                                <TableRow
                                    key={row.id}
                                    data-state={
                                        row.getIsSelected() && 'selected'
                                    }
                                >
                                    {row.getVisibleCells().map((cell) => (
                                        <TableCell key={cell.id}>
                                            {flexRender(
                                                cell.column.columnDef.cell,
                                                cell.getContext(),
                                            )}
                                        </TableCell>
                                    ))}
                                </TableRow>
                            ))
                        ) : (
                            <TableRow>
                                <TableCell
                                    colSpan={table.getAllColumns().length}
                                    className="h-24 text-center font-medium text-gray-900"
                                >
                                    Tidak ada data yang ditemukan.
                                </TableCell>
                            </TableRow>
                        )}
                    </TableBody>
                </Table>
                {table.getPageCount() > 1 && (
                    <DataTablePagination table={table} />
                )}
            </div>
        </div>
    );
}
