import Button from '@/Components/UI/Button';
import { DataTable } from '@/Components/UI/DataTable';
import { type PageProps } from '@/types';
import { RiArrowDownLine, RiArrowUpLine } from '@remixicon/react';
import {
    getCoreRowModel,
    getSortedRowModel,
    useReactTable,
    type ColumnDef,
    type SortingState,
} from '@tanstack/react-table';
import { useMemo, useState } from 'react';

interface Project {
    id: string;
    title: string;
    description?: string;
    sektor_id: string;
}

const ProgramDataTable = ({ data }: PageProps<{ data: Project[] }>) => {
    const columns = useMemo<ColumnDef<Project>[]>(
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

    const [sorting, setSorting] = useState<SortingState>([]);

    const table = useReactTable({
        data,
        columns,
        rowCount: data.length,
        state: {
            sorting,
        },
        onSortingChange: setSorting,
        getCoreRowModel: getCoreRowModel(),
        getSortedRowModel: getSortedRowModel(),
    });

    return <DataTable table={table} />;
};

export default ProgramDataTable;
