import { PageProps, Sektor } from '@/types';
import { Link } from '@inertiajs/react';
import {
    RiArrowDownLine,
    RiArrowUpLine,
    RiEyeLine,
    RiPencilLine,
} from '@remixicon/react';
import { ColumnDef } from '@tanstack/react-table';
import { useMemo } from 'react';
import Button from '../../UI/Button';
import { DataTable } from '../../UI/DataTable';

const SektorDataTable = ({ data, pagination }: PageProps) => {
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

    return <DataTable columns={columns} data={data} pagination={pagination} />;
};

export default SektorDataTable;
