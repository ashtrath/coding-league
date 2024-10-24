import { Mitra } from '@/Pages/Dashboard/Mitra';
import { PageProps, Pagination } from '@/types';
import { Link, router } from '@inertiajs/react';
import {
    RiArrowDownLine,
    RiArrowUpLine,
    RiEyeLine,
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
import Badge from '../UI/Badge';
import Button from '../UI/Button';
import { DataTable } from '../UI/DataTable';

const MitraDataTable = ({
    data,
    pagination,
}: PageProps<{ data: Mitra[]; pagination: Pagination }>) => {
    const columns = useMemo<ColumnDef<Mitra>[]>(
        () => [
            {
                accessorKey: 'image',
                size: 228,
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
                            FOTO
                            {column.getIsSorted() === 'asc' ? (
                                <RiArrowUpLine className="ml-2 size-5" />
                            ) : (
                                <RiArrowDownLine className="ml-2 size-5" />
                            )}
                        </Button>
                    );
                },
                cell: ({ row }) => {
                    const data = row.original;

                    return (
                        <div className="h-[100px] max-w-[180px] rounded-xl bg-slate-200">
                            {data.image ? (
                                <img
                                    className="h-[100px] max-w-[180px] rounded-xl object-scale-down"
                                    src={`/storage/${data.image}`}
                                />
                            ) : (
                                <p className="grid size-full place-items-center text-xs font-medium text-gray-400">
                                    No Image.
                                </p>
                            )}
                        </div>
                    );
                },
            },
            {
                accessorKey: 'name_mitra',
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
                            NAMA
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
                accessorKey: 'name_company',
                header: ({ column }) => {
                    return (
                        <Button
                            variant="ghost"
                            onClick={() => {
                                column.toggleSorting(
                                    column.getIsSorted() === 'asc',
                                );
                            }}
                            className="text-sm"
                        >
                            NAMA PT
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
                            DESKRIPSI
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
                accessorKey: 'created_at',
                size: 181,
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
                            TGL TERDAFTAR
                            {column.getIsSorted() === 'asc' ? (
                                <RiArrowUpLine className="ml-2 size-5" />
                            ) : (
                                <RiArrowDownLine className="ml-2 size-5" />
                            )}
                        </Button>
                    );
                },
                cell: ({ row }) => {
                    const data = row.original;
                    return new Date(data.created_at).toLocaleDateString(
                        'id-ID',
                        {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric',
                        },
                    );
                },
            },
            {
                accessorKey: 'status',
                size: 123,
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
                            STATUS
                            {column.getIsSorted() === 'asc' ? (
                                <RiArrowUpLine className="ml-2 size-5" />
                            ) : (
                                <RiArrowDownLine className="ml-2 size-5" />
                            )}
                        </Button>
                    );
                },
                cell: ({ row }) => {
                    const data = row.original;
                    return data.status === 'Active' ? (
                        <Badge variant="success">Aktif</Badge>
                    ) : (
                        <Badge variant="error">Non-Aktif</Badge>
                    );
                },
            },
            {
                id: 'actions',
                size: 81,
                header: () => {
                    return <div className="text-center">AKSI</div>;
                },
                cell: ({ row }) => {
                    const data = row.original;

                    return (
                        <div className="grid place-items-center">
                            <Button variant="ghost" size="icon" asChild>
                                <Link
                                    href={route(
                                        'dashboard.mitra.show',
                                        data.id,
                                    )}
                                >
                                    <RiEyeLine className="size-6" />
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
                        (table
                            .getColumn('name_mitra' || 'name_company')
                            ?.getFilterValue() as string) ?? ''
                    }
                    onChange={(event) =>
                        table
                            .getColumn('name_mitra' || 'name_company')
                            ?.setFilterValue(event.target.value)
                    }
                    className="flex h-12 w-full gap-2.5 rounded-lg border border-gray-300 bg-white px-4 py-2 pl-12 text-sm font-medium text-gray-800 shadow-sm placeholder:text-gray-400"
                />
            </div>
        </DataTable>
    );
};

export default MitraDataTable;
