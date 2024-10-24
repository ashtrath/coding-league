import Button from '@/Components/UI/Button';
import { DataTable } from '@/Components/UI/DataTable';
import { PageProps } from '@/types';
import { RiArrowDownLine, RiArrowUpLine } from '@remixicon/react';
import { ColumnDef } from '@tanstack/react-table';
import { useMemo } from 'react';

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

    return <DataTable columns={columns} data={data} />;
};

export default ProgramDataTable;
