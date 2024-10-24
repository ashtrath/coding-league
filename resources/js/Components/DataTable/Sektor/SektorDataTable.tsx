import { Sektor } from '@/Pages/Dashboard/Sektor';
import { PageProps, Pagination } from '@/types';
import { Link, router } from '@inertiajs/react';
import {
    RiArrowDownLine,
    RiArrowUpLine,
    RiEyeLine,
    RiPencilLine,
    RiSearchLine,
} from '@remixicon/react';
import {
    getCoreRowModel,
    getFilteredRowModel,
    getSortedRowModel,
    useReactTable,
    type ColumnDef,
    type ColumnFiltersState,
    type SortingState,
} from '@tanstack/react-table';
import { useMemo, useState } from 'react';
import Button from '../../UI/Button';
import { DataTable } from '../../UI/DataTable';

const SektorDataTable = ({
    data,
    pagination,
}: PageProps<{ data: Sektor[]; pagination: Pagination }>) => {
    const columns = useMemo<ColumnDef<Sektor>[]>(
        () => [
            {
                accessorKey: 'name',
                header: ({ column }) => {
                    return (
                        <Button
                            variant="ghost"
                            onClick={() =>
                                column.toggleSorting(
                                    column.getIsSorted() === 'asc',
                                )
                            }
                            className="text-sm"
                        >
                            NAMA SEKTOR
                            {column.getIsSorted() === 'asc' ? (
                                <RiArrowUpLine className="ml-2 size-5" />
                            ) : (
                                <RiArrowDownLine className="ml-2 size-5" />
                            )}
                        </Button>
                    );
                },
            },
            {
                accessorKey: 'description',
                header: ({ column }) => {
                    return (
                        <Button
                            variant="ghost"
                            onClick={() =>
                                column.toggleSorting(
                                    column.getIsSorted() === 'asc',
                                )
                            }
                            className="text-sm"
                        >
                            DESKRIPSI SEKTOR
                            {column.getIsSorted() === 'asc' ? (
                                <RiArrowUpLine className="ml-2 size-5" />
                            ) : (
                                <RiArrowDownLine className="ml-2 size-5" />
                            )}
                        </Button>
                    );
                },
            },
            {
                id: 'actions',
                header: () => {
                    return <div className="text-center">AKSI</div>;
                },
                cell: ({ row }) => {
                    const sektor = row.original;

                    return (
                        <div className="flex items-center justify-center gap-1">
                            <Button variant="ghost" size="icon" asChild>
                                <Link
                                    href={route(
                                        'dashboard.sektor.show',
                                        sektor.id,
                                    )}
                                >
                                    <RiEyeLine className="size-6" />
                                </Link>
                            </Button>
                            <Button variant="ghost" size="icon" asChild>
                                <Link
                                    href={route(
                                        'dashboard.sektor.edit',
                                        sektor.id,
                                    )}
                                >
                                    <RiPencilLine className="size-6" />
                                </Link>
                            </Button>
                        </div>
                    );
                },
            },
        ],
        [],
    );

    const [sorting, setSorting] = useState<SortingState>([]);
    const [columnFilters, setColumnFilters] = useState<ColumnFiltersState>([]);

    const table = useReactTable({
        data,
        columns,
        rowCount: pagination ? pagination.total : data.length,
        manualPagination: !!pagination,
        state: {
            sorting,
            columnFilters,
            pagination: pagination
                ? {
                      pageIndex: pagination.current_page - 1,
                      pageSize: pagination.per_page,
                  }
                : undefined,
        },
        onPaginationChange: (updater) => {
            const newPagination =
                typeof updater === 'function'
                    ? updater(table.getState().pagination)
                    : updater;

            router.get(window.location.href, {
                page: newPagination.pageIndex + 1,
                per_page: newPagination.pageSize,
            });
        },
        onSortingChange: setSorting,
        onColumnFiltersChange: setColumnFilters,
        getCoreRowModel: getCoreRowModel(),
        getSortedRowModel: getSortedRowModel(),
        getFilteredRowModel: getFilteredRowModel(),
    });

    return (
        <DataTable table={table}>
            <div className="flex items-center">
                <div className="flex items-center justify-around">
                    <RiSearchLine className="absolute ml-12 size-5 text-gray-500" />
                </div>
                <input
                    type="text"
                    placeholder="Cari"
                    value={
                        (table.getColumn('name')?.getFilterValue() as string) ??
                        ''
                    }
                    onChange={(event) =>
                        table
                            .getColumn('name')
                            ?.setFilterValue(event.target.value)
                    }
                    className="flex h-12 w-full gap-2.5 rounded-lg border border-gray-300 bg-white px-4 py-2 pl-12 text-sm font-medium text-gray-800 shadow-sm placeholder:text-gray-400"
                />
            </div>
        </DataTable>
    );
};

export default SektorDataTable;
