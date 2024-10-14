import Button from '@/Components/UI/Button';
import { DataTable } from '@/Components/UI/DataTable';
import { PageProps, Sektor } from '@/types';
import { RiArrowDownLine, RiArrowUpLine } from '@remixicon/react';
import { ColumnDef } from '@tanstack/react-table';
import { useMemo } from 'react';

const ProgramDataTable = ({ data }: PageProps) => {
    const columns = useMemo<ColumnDef<Sektor>[]>(
        () => [
            {
                accessorKey: 'title',
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
                            NAMA PROGRAM
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
                            DESKRIPSI PROGRAM
                            {column.getIsSorted() === 'asc' ? (
                                <RiArrowUpLine className="ml-2 size-5" />
                            ) : (
                                <RiArrowDownLine className="ml-2 size-5" />
                            )}
                        </Button>
                    );
                },
            },
        ],
        [],
    );

    return <DataTable columns={columns} data={data} />;
};

export default ProgramDataTable;
